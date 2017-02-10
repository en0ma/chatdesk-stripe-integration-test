<?php
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class Processor
{
    /**
     * test amount.
     * 
     * @var int
     */
    protected $amount = 2;

    /**
     * Stripe secret key
     */
    const API_KEY = getenv('STRIPE_SECRET_KEY');

    /**
     * Create a provider instance and setup stripe api key
     * Processor constructor.
     */
    public function __construct()
    {
        Stripe::setApiKey(self::API_KEY);
    }

    /** Create a new stripe charge on customer.
     *
     * @param $params
     */
    public function charge($params)
    {
        try {
            $customer = $this->createCustomer($params['token']);
            $amount = $this->calculateAmount($this->amount);

            Charge::create([
                'customer' => $customer,
                'amount' => $amount,
                'currency' => $this->getCurrency()
            ]);
            echo 'Payment successful, pay again.';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Create a customer to attach to stripe payment.
     *
     * @param $token
     * @return string
     */
    protected function createCustomer($token)
    {
        $customer = Customer::create([
            'source' => $token,
        ]);

        return $customer->id;
    }

    /**
     * Normalize amount to lowest denomination.
     * e.g cents
     *
     * @param $amount
     * @return mixed
     */
    protected function calculateAmount($amount)
    {
        return $amount * 100;
    }

    /**
     * Determine charge currency.
     *
     * @return string
     */
    protected function getCurrency()
    {
        //Currency determination should be more detailed.
        return 'usd';
    }
}
