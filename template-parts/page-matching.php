<?php

$code_clubs = null;
$host_volunteer_matching = new Host_Volunteer_Matching();

if (empty( $_POST['body_text'] ) && !empty($_POST['address'])) {
  $code_clubs = $host_volunteer_matching->getCodeClubs($_POST['address']);
}

?>

<div class="c-page-block">
  <h1 class="u-text--center">Find Club</h1>
  <div class="c-grid c-grid--h-center">
    <div class="c-col c-col--6">
      <p>Let's find a Club near you.</p>
      <form  id="find-hosts" action="#" method="POST">
        <!-- anti-spam field start -->
        <div style="display: none;">
          <!-- the field name is purposefully *not* something obvious, such as "honeypot" -->
          <label for="body_text">Keep this field blank</label>
          <input type="text" name="body_text" id="body_text">
        </div>
        <!-- anti-spam field end -->
        <label class="c-form__label" for="address">Address</label>
        <input class="c-form__input u-margin--none" type="text" name="address" id="address"
                value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>"/>
        <p class="u-text--center u-margin-top--base">
          <button class="c-button c-button--green" type="submit" form="find-hosts">
            Search
          </button>
        </p>
      </form>
    </div>
  </div>
</div>


<?php if (isset($code_clubs)): ?>
  <div class="c-page-block c-page-block--alt-block">
    <h2 class="u-text--center">Search results: <?php echo sizeof($code_clubs);?></h2>
    <div class="c-grid c-grid--h-center">
      <?php foreach ($code_clubs as $code_club): ?>

        <div class="c-card c-col c-col--4">
          <div class="c-card__body">
            <h4><?php echo $code_club['venue']['name']; ?></h4>
            <p class="c-meta">
              <?php echo $code_club['venue']['address']['address_1'] . ' ' .
                $code_club['venue']['address']['address_2'] . ' ' .
                $code_club['venue']['address']['city'] . ' ' .
                $code_club['venue']['address']['postcode']; ?>
            </p>

            <?php if (!empty($code_club['venue']['phone'])): ?>
              <span><?php echo $code_club['venue']['phone']; ?> </span>
            <?php endif; ?>
          </div>
          <div class="c-card__footer">
            <a class="c-card__link" href="/contact-form?club_id=<?php echo $code_club['id']; ?>">
              Contact Club Host
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>

