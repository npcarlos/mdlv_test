<?php

use Faker\Factory as Faker;
use App\Models\PaymentStatus;
use App\Repositories\PaymentStatusRepository;

trait MakePaymentStatusTrait
{
    /**
     * Create fake instance of PaymentStatus and save it in database
     *
     * @param array $paymentStatusFields
     * @return PaymentStatus
     */
    public function makePaymentStatus($paymentStatusFields = [])
    {
        /** @var PaymentStatusRepository $paymentStatusRepo */
        $paymentStatusRepo = App::make(PaymentStatusRepository::class);
        $theme = $this->fakePaymentStatusData($paymentStatusFields);
        return $paymentStatusRepo->create($theme);
    }

    /**
     * Get fake instance of PaymentStatus
     *
     * @param array $paymentStatusFields
     * @return PaymentStatus
     */
    public function fakePaymentStatus($paymentStatusFields = [])
    {
        return new PaymentStatus($this->fakePaymentStatusData($paymentStatusFields));
    }

    /**
     * Get fake data of PaymentStatus
     *
     * @param array $postFields
     * @return array
     */
    public function fakePaymentStatusData($paymentStatusFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $paymentStatusFields);
    }
}
