<div class="offers">

    <h1>Oferty specjalne</h1>

<?php foreach ($SpecialOffers as $SpecialOffer){ ?>

<div class="name"><?php echo $SpecialOffer->getName(); ?></div>
<div class="text"><?php echo $SpecialOffer->getText(); ?></div>
<?php } ?>
</div>