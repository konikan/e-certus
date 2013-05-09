<?php

/**
 * ShippingTypes form.
 *
 * @package    e-certus
 * @subpackage form
 * @author     Your name here
 */
class ShippingTypesForm extends BaseShippingTypesForm
{
  public function configure()
  {
     $this->widgetSchema->setLabels(array(

      'group_id'              => 'Grupa',
      'packaging_type_id'     => 'Rodzaj opakowania',
      'name'                  => 'Nazwa',
      'is_active'             => 'Aktywne',
      'show_in_tariff'        => 'Pokazuj w cenniku',
      'price'                 => 'Cena netto',
      'initial_weight'        => 'Waga początkowa',
      'final_weight'          => 'Waga końcowa',
      'is_prom'               => 'Promocja',
      'prom_price'            => 'Cena promocyjna',
      'is_dynamic_price'      => 'Cena może się zmieniać',
      'dynamic_price'         => 'Kwota zmiany',
      'dynamic_price_what_if' => 'Częstotliwość wagowa zmiany ceny',
      'show'                  => 'Pokazuj',
      'is_available'          => 'Dostępny',
      'notice'                => 'Uwagi',
    ));
  }
}
