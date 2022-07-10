<div class="row my-3 m-lg-5 p-lg-5 row-cols-1 row-cols-lg-2 g-4 bg-light">
<div class="col-12 col-md-8 sr-links">
    <h3><strong>Plot No: </strong><?php echo $card_title; ?></h1>
    <h3><strong>Status: </strong><?php echo $card_author; ?></h3>
    <h3><strong>Applied On: </strong><?php echo date("F d, Y", strtotime($card_date)); ?></h3>
    <h3><strong>Occupant Name: </strong><?php echo $card_tag; ?></h3>
    <h3><strong>Contact: </strong><?php echo $card_text; ?></h3>
</div>
</div>