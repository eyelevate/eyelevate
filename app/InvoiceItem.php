<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Job;
use App\RoleUser;
use App\User;
use App\Tax;

class InvoiceItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice_items';

    public static function makeTableRow($title,$description,$quantity,$subtotal,$tax_id) {
    	$taxes = Tax::find($tax_id);
    	$tax_rate = $taxes->rate;
    	$tax_country = $taxes->country;
    	$total_subtotal = InvoiceItem::currencyFormat($tax_country,$subtotal);
    	$total_tax = InvoiceItem::currencyFormat($tax_country,InvoiceItem::calculateTax($subtotal, $tax_rate));
    	$total_due = InvoiceItem::currencyFormat($tax_country,InvoiceItem::calculateTotalDue($subtotal, $tax_rate));
    	$row = '<tr>';
    	$row .= '<td>'.$title.' <input name="" class="invoiceItem-title" type="hidden" value="'.$title.'"/></td>';
    	$row .= '<td>'.$description.' <input name="" class="invoiceItem-description" type="hidden" value="'.$description.'"/></td>';
    	$row .= '<td>'.$quantity.'<input name="" class="invoiceItem-quantity" type="hidden" value="'.$quantity.'"/></td>';
    	$row .= '<td>'.$total_subtotal.' <input name="" class="invoiceItem-subtotal" type="hidden" value="'.$subtotal.'"/></td>';
    	$row .= '<td>'.$total_tax.' <input name="" class="invoiceItem-tax" type="hidden" value="'.InvoiceItem::calculateTax($subtotal, $tax_rate).'"/> <input name="" class="invoiceItem-taxId" type="hidden" value="'.$tax_id.'"/></td>';
    	$row .= '<td>'.$total_due.' <input name="" class="invoiceItem-due" type="hidden" value="'.InvoiceItem::calculateTotalDue($subtotal, $tax_rate).'"/></td>';
    	$row .= '<td><button type="button" class="removeRow btn btn-sm btn-danger">remove</button></td>';
    	$row .= '</tr>';

    	return $row;
    }

    private static function calculateTax($subtotal, $rate){
    	return round($subtotal * $rate,2);
    }

    private static function calculateTotalDue($subtotal, $rate) {
    	return round($subtotal * (1+$rate),2);
    }

    private static function currencyFormat($tax_country,$amount) {
    	$country_code = Job::country_code_locale($tax_country);
    	Job::dump($country_code);
    	setlocale(LC_MONETARY, $country_code);

    	return money_format('%n', $amount);
    }
}