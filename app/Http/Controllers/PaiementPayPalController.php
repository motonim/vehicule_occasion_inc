<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaiementPaypal;
use Gloudemans\Shoppingcart\Facades\Cart;
use Omnipay\Omnipay;

class PaiementPayPalController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->prix,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();

            if($response->isRedirect()) {
                $response->redirect();
            }
            else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request) {
        if($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();

            if($response->isSuccessful()){
                $arr = $response->getData();

                $payment = new PaiementPaypal;
                $payment->paiement_id = $arr['id'];
                $payment->payeur_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payeur_courriel = $arr['payer']['payer_info']['email'];
                $payment->prix = $arr['transactions'][0]['amount']['total'];
                $payment->monnaie = env('PAYPAL_CURRENCY');
                $payment->paiement_statut = $arr['state'];

                $payment->save();

                Cart::destroy();
                
                return redirect(route('commande.index'))->with('success', "Le paiement a ??t?? effectu??. L'ID transaction est : " . $arr['id']);
            }
            else {
                return $response->getMessage();
            }
        }
        else {
            return 'Le paiement a ??t?? refus??.';
        }

    }

    public function error() {
        return "L'utilisateur a refus?? le paiement.";
    }
}
