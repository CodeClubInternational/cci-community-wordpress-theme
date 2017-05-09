<div class="c-content-panel">
  <dl class="c-def-list">
    <h4><?php esc_html_e("Account", 'ccw_countries') ?></h4>
    <dt class="c-def-list__term">
      <?php esc_html_e("Username", 'ccw_countries') ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['username']) ?></dd>
  </dl>
</div>

<div class="c-content-panel">
  <dl class="c-def-list">
    <h4><?php esc_html_e("Contact", 'ccw_countries'); ?></h4>
    <dt class="c-def-list__term">
      <?php esc_html_e("Name", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['contact']['name']) ?></dd>
    <dt class="c-def-list__term">
      <?php esc_html_e("Email", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['contact']['email']) ?></dd>
    <dt class="c-def-list__term">
      Skype
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['contact']['skype']) ?></dd>
  </dl>
</div>

<div class="c-content-panel">
  <dl class="c-def-list">
    <h4><?php esc_html_e("Venue", 'ccw_countries'); ?></h4>
    <dt class="c-def-list__term">
      <?php esc_html_e("Name", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['venue']['name']) ?></dd>
    <?php if (!$club['can_run_without_volunteer']): ?>
      <dt class="c-def-list__term">
        <?php esc_html_e("Looking for Volunteer", 'ccw_countries'); ?>
      </dt>
      <dd class="c-def-list__definition"><?php
        echo get_yes_no(htmlspecialchars($_SESSION['club']['looking_for_volunteer']))
        ?></dd>
    <?php endif?>
    <dt class="c-def-list__term">
      <?php esc_html_e("Happy to be contacted", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php
      echo get_yes_no(htmlspecialchars($_SESSION['club']['happy_to_be_contacted']))
      ?></dd>
    <dt class="c-def-list__term">
      <?php esc_html_e("Website", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['venue']['url']) ?></dd>
    <dt class="c-def-list__term">
      <?php esc_html_e("Street address 1", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['venue']['address']['address_1']) ?></dd>
    <dt class="c-def-list__term">
      <?php esc_html_e("Street address 2", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['venue']['address']['address_2']) ?></dd>
    <dt class="c-def-list__term">
      <?php esc_html_e("Town / City", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['venue']['address']['city']) ?></dd>
    <dt class="c-def-list__term">
      <?php esc_html_e("Region / State", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['venue']['address']['region']) ?></dd>
    <dt class="c-def-list__term">
      <?php esc_html_e("Postcode / Zipcode", 'ccw_countries'); ?>
    </dt>
    <dd class="c-def-list__definition"><?php echo htmlspecialchars($_SESSION['club']['venue']['address']['postcode']) ?></dd>
  </dl>
</div>
