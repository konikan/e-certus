<div class="user_info">
    <div style="margin: 10px 0px 10px 0px;">Witaj: <b><?php echo $user->getName() ?></b></div>


<div><?php echo link_to(image_tag('menu_po_zalogowaniu/dane_uzytkownika.jpg'),'user/info') ?></div>

<div><?php echo link_to(image_tag('menu_po_zalogowaniu/przesylki.jpg'),'user/shippings') ?></div>

<div><?php echo link_to(image_tag('menu_po_zalogowaniu/ksiazka_nadawcow.jpg'),'senders_book/index') ?></div>

<div><?php echo link_to(image_tag('menu_po_zalogowaniu/ksiazka_odbiorcow.jpg'),'recipients_book/index') ?></div>

<div><?php echo link_to(image_tag('menu_po_zalogowaniu/oferty_specjalne.jpg'),'special_offers/index') ?></div>

<div><?php echo link_to(image_tag('menu_po_zalogowaniu/wyloguj.jpg'),'user/logout') ?></div>
</div>