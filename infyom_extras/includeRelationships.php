<?php

require_once ( "../vendor/doctrine/inflector/lib/Doctrine/Common/Inflector/Inflector.php");
require_once ( "../vendor/laravel/framework/src/Illuminate/Support/Pluralizer.php");




use Doctrine\Common\Inflector\Inflector;
use Illuminate\Support\Pluralizer;
//print_r(get_declared_classes());
echo "<h1> Agregando relaciones</h1>";

//escribirOneToMany();
//escribirManyToOne();

agregarHiddenYAppendsAModelos();


    


function agregarHiddenYAppendsAModelos()
{
    
    echo "<h1>Agregar Hidden, Appends y UUID</h1>";
    $directorio = "../app/Models/";
 
    $archivos  = scandir($directorio);
    
    for($i = 2; $i < sizeof($archivos); $i++)
    {
    
        $archivoActual = $archivos[$i];
        echo "<br><b>".$archivoActual."</b><br>";
        
        $handle = fopen($directorio.$archivoActual, "r");
        
        if ($handle) {
            
            $contenido = "";
            
            $inicioCast = false;
            $finCast = false;
            $codigoAgregado = false;
            
            $leyendoUses = false;
            
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                
                $contenido .= $line;
                
                //----------------------------------
                // Creación de los uses
                //----------------------------------
                
                if(substr( $line, 0, 4 ) === "use ")
                {
                    $leyendoUses = true;
                }
                else if( $leyendoUses)
                {
                    $contenido .= "use Illuminate\Support\Str;\n";
                   
                    
                    $contenido .="\n\n";
                    $leyendoUses = false;
                }
                
                
                if(strcmp(trimLinea($line), trimLinea("protected \$casts = [") ) == 0)
                {
                    $inicioCast = true;
                }
                if($inicioCast && strcmp(trimLinea($line), trimLinea("];") ) == 0)
                {
                    $finCast = true;
                }
                
                if($inicioCast && $finCast  && !$codigoAgregado)
                {
               
                    $contenido .= imprimirLinea("\n");
                    
                    $contenido .= imprimirLinea("protected \$hidden = [");
                    $contenido .= imprimirLinea("    'id',");
                    $contenido .= imprimirLinea("    'created_at',");
                    $contenido .= imprimirLinea("    'updated_at',");
                    $contenido .= imprimirLinea("    'deleted_at'");
                    $contenido .= imprimirLinea("];");
                    
                    $contenido .= imprimirLinea("\n");
                    
                    $contenido .= imprimirLinea("protected \$appends = [");
                    $contenido .= imprimirLinea("];");
                    
                    
                    $contenido .= imprimirLinea("\n");
                    
                    $contenido .= imprimirLinea("public static function boot()");
                    $contenido .= imprimirLinea("{");
                    $contenido .= imprimirLinea("    parent::boot();");
                    $contenido .= imprimirLinea("");
                    $contenido .= imprimirLinea("    static::saving(function(\$image){");
                    $contenido .= imprimirLinea("        if(!isset(\$image->attributes['uuid']))  {");
                    $contenido .= imprimirLinea("            \$image->attributes['uuid'] = Str::uuid();");
                    $contenido .= imprimirLinea("        }");
                    $contenido .= imprimirLinea("    });");
                    $contenido .= imprimirLinea("}");
                    
                    $codigoAgregado = true;
                }
            }

            fclose($handle);
    
            
            $otro = fopen($directorio.$archivoActual, "w");
            fwrite($otro, $contenido);
            fclose($otro);
            
        } else {
            // error opening the file.
        } 
    }
}




/**
* Modifica los modelos incluyendo las relaciones HasMany
*/
function escribirOneToMany()
{
    // Leer posibles relaciones
    echo "<h1>One to Many</h1>";
    $jsonRelaciones = file_get_contents("1tm.json");
    $modelosRelaciones = json_decode($jsonRelaciones, true);

    foreach ($modelosRelaciones as $obj)    
    {
        $relations = $obj["relations"];
        
        escribirRelacionHasMany($obj["model"], $obj["relations"]);
       
    }  
}

function escribirManyToOne()
{
    // Leer posibles relaciones
    echo "<h1>Many to one</h1>";

    $jsonRelaciones = file_get_contents("mt1.json");
    $modelosRelaciones = json_decode($jsonRelaciones, true);

    foreach ($modelosRelaciones as $obj)    
    {
        echo Pluralizer::plural($obj["model"])."<br>";
        $relations = $obj["relations"];
        
        modificarControlladoresWeb($obj["model"], $obj["relations"]);
        modificarFieldsBlade($obj["model"], $obj["relations"]);
    }

}
    
    

function modificarFieldsBlade($modelo, $relaciones)
{
    $directorio = "../resources/views/".snake(Pluralizer::plural($modelo))."/";
    $archivoActual = "fields.blade.php";
    echo "<br><b>".$modelo."</b><br>";
    
    $handle = fopen($directorio.$archivoActual, "r");
    
    if ($handle) {
        
        $puedeEscribirLinea = true;
        $bufferLineas = "";
        
        $contenido = "";
        
        $iniciarVariablesConsulta = false;
        $yaEscribioVariablesConsulta = false;
       
        
        $leyendoUses = false;
        
        while (($line = fgets($handle)) !== false) {
            $lineaTrim = trimLinea($line);
            $buscada = "{!! Form::select(";
            if(substr( $lineaTrim, 0, strlen($buscada) ) === $buscada)
            {
                $tieneID = strpos($lineaTrim, "_id',") !== false;
                if($tieneID)
                {
                    $partes = explode("'", $lineaTrim)[1];
                    $modeloRelacion = substr($partes, 0, -3);
                    $modeloRelacionCamel = lcfirst(Pluralizer::plural(camel($modeloRelacion)));
                    $contenido .= imprimirLinea("{!! Form::select('$partes', \$$modeloRelacionCamel, null, ['class' => 'form-control']) !!}", 2);
                }
                else
                {
                    $contenido .= $line;
                }
            }
            else
            {
                $contenido .= $line;    
            }
            
        }

        fclose($handle);
   
        
        $otro = fopen($directorio.$archivoActual, "w");
        fwrite($otro, $contenido);
        fclose($otro);
        
    } else {
        // error opening the file.
    } 
}

    
function modificarControlladoresWeb($modelo, $relaciones)
{
    $directorio = "../app/Http/Controllers/";
    $archivoActual = $modelo."Controller.php";
    echo "<br><b>".$modelo."</b><br>";
    
    $handle = fopen($directorio.$archivoActual, "r");
    
    if ($handle) {
        
        $puedeEscribirLinea = true;
        $bufferLineas = "";
        
        $contenido = "";
        
        $iniciarVariablesConsulta = false;
        $yaEscribioVariablesConsulta = false;
       
        
        $leyendoUses = false;
        
        while (($line = fgets($handle)) !== false) {
            $lineaTrim = trimLinea($line);
            // process the line read.
            if(!$iniciarVariablesConsulta)
            {
                $contenido .= $line;
            }
            
            
            
            //----------------------------------
            // Creación de los uses
            //----------------------------------
            
            if(substr( $line, 0, 4 ) === "use ")
            {
                $leyendoUses = true;
            }
            else if( $leyendoUses)
            {
                foreach($relaciones as $relacion)
                {
                    $contenido .= "use App\Models\\$relacion;\n";
                }
                   
                $contenido .="\n\n";
                $leyendoUses = false;
            }
            
            //----------------------------------
            // Llamado a los valores de las relaciones
            //----------------------------------
            if(strcmp($lineaTrim, trimLinea("public function create()") ) == 0 ||
              strcmp($lineaTrim, trimLinea("public function edit(\$id)") ) == 0)
            {
                $iniciarVariablesConsulta = true;
                $yaEscribioVariablesConsulta = false;
            }
            else if($iniciarVariablesConsulta)
            {
                if(substr( $lineaTrim, 0, strlen("return view") ) === "return view")
                {
                    $isCreate = strpos($lineaTrim, ".create") !== false;
                    
                    $variables = ($isCreate ? "" : "'" . lcfirst($modelo)."', ");
                    
                    foreach($relaciones as $relacion)
                    {
                        $variables .= "'".lcfirst(Pluralizer::plural($relacion))."'";
                        if( next( $relaciones ) ) {
                            $variables .= ", ";
                        }
                    }
                    
                    $vista = "return view('" . snake(Pluralizer::plural($modelo)) . "." . ($isCreate?"create":"edit") ."', compact($variables));";
                    $contenido .= imprimirLinea($vista, 2);
                    $iniciarVariablesConsulta = false;
                }
                else
                {
                    
                    $contenido .= $line;
                    
                    if($yaEscribioVariablesConsulta == false)
                    {
                        foreach($relaciones as $relacion)
                        {
                            $variable = lcfirst(Pluralizer::plural($relacion));
                            $contenido .= imprimirLinea("$".$variable." = ".$relacion."::all()->pluck('labelSelect', 'id');", 2);
                        }
                        $contenido .="\n";
                        $yaEscribioVariablesConsulta = true;        
                    }
                }
                
                
            }
        }

        fclose($handle);
   
        
        $otro = fopen($directorio.$archivoActual, "w");
        fwrite($otro, $contenido);
        fclose($otro);
        
    } else {
        // error opening the file.
    } 
}

function trimLinea($linea)
{
    return trim(htmlspecialchars($linea));
}

function escribirRelacionHasMany($modelo, $relaciones)
{
    $directorio = "../app/Models/";
    $archivoActual = $modelo.".php";
    echo "<br><b>".$modelo."</b><br>";
    
    $handle = fopen($directorio.$archivoActual, "r");
    
    if ($handle) {
        
        $contenido = "";
        
        $inicioRules = false;
        $finRules = false;
        $codigoAgregado = false;
        
        while (($line = fgets($handle)) !== false) {
            // process the line read.
            
            $contenido .= $line;
            if(strcmp(trim(htmlspecialchars($line)), trim( htmlspecialchars("public static \$rules = [") )) == 0)
            {
                $inicioRules = true;
            }
            if($inicioRules && strcmp(trim(htmlspecialchars($line)), trim( htmlspecialchars("];") )) == 0)
            {
                $finRules = true;
            }
            
            if($inicioRules && $finRules  && !$codigoAgregado)
            {
                
                
                $contenido .= "\n";

                $contenido .= imprimirLinea("/**");
                $contenido .= imprimirLinea("* @return A string which contains the text to be used in the select");
                $contenido .= imprimirLinea("**/");
                $contenido .= imprimirLinea("public function getLabelSelectAttribute() {");
                $contenido .= imprimirLinea("    return \$this->name;");
                $contenido .= imprimirLinea("}");

	                
                
                foreach ($relaciones as $relation) 
                {
                    $singular = $relation;
                    $plural = lcfirst(Pluralizer::plural($relation));
                    
                    echo "- ".$singular."<br>";
                    $contenido .= "\n";
                    $contenido .= imprimirLinea("/**");
                    $contenido .= imprimirLinea("* @return \Illuminate\Database\Eloquent\Relations\HasMany");
                    $contenido .= imprimirLinea("**/");
                    $contenido .= imprimirLinea("public function $plural()");
                    $contenido .= imprimirLinea("{");
                    $contenido .= imprimirLinea("return \$this->hasMany(\App\Models\\$singular::class);", 2);
                    $contenido .= imprimirLinea("}");
                    $contenido .= "\n";
                }
                
               
                
                $codigoAgregado = true;
            }
        }

        fclose($handle);
   
        
        $otro = fopen($directorio.$archivoActual, "w");
        fwrite($otro, $contenido);
        fclose($otro);
        
    } else {
        // error opening the file.
    } 
}


function imprimirLinea($linea, $indentLevel = 1)
{
    $lineaCompleta = "";
    for ($i=0; $i < $indentLevel; $i++) { 
        $lineaCompleta .="\t";
    }
    $lineaCompleta .= $linea;
    $lineaCompleta .= "\n";
    return $lineaCompleta;
}


function getDatetimeNow() {
    $tz_object = new DateTimeZone('America/Lima');
    //date_default_timezone_set('Brazil/East');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    return $datetime->format('Y\-m\-d\ h:i:s');
}

/**
     * Convert a string to snake case.
     *
     * @param  string  $value
     * @param  string  $delimiter
     * @return string
     */
    function snake($value, $delimiter = '_')
    {
        $key = $value;

        
        if (! ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));
            $value = mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $value), 'UTF-8');
        }

        return $value;
    }
    
    function camel($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return ucfirst( str_replace(' ', '', $value));
    }

echo "<br><br><h1>Fin  ".getDatetimeNow()."</h1>";
?>