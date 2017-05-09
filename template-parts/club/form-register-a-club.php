<form class="c-form"
      id="register-club"
      action=""
      method="POST"
      data-parsley-validate="">

  <?php
  // The form uses a honeypot field called "body_text", purposefully named so as to not be obvious to spam bots

  $templates = new League\Plates\Engine(get_template_directory() . '/template-parts/shared/');

  $error_message = '';
  $error_messages = array();

  ini_set('display_errors', 1);
  error_reporting(E_ALL ^ E_NOTICE);

  if (empty($_POST['body_text']) && !empty($_POST['terms-checkbox'])) {
    $_POST['club']['name'] = $_POST['club']['venue_attributes']['name'];
    $_POST['club']['looking_for_volunteer'] = false;

    $club_json = strip_slashes_json_encode($_POST);

    $ccw_api   = new CCW_API();
    $response  = $ccw_api->createClub($club_json);

    $error_messages = react_to_response($response, 201, function () {
      $flash_messages = new Flash_Message();
      $flash_messages->createSuccess(__('Your club has now been registered'), 'ccw_countries');
      wp_safe_redirect('/register/thank-you/');
      exit;
    });
  }

  ?>


  <fieldset class="c-form__fieldset">
    <h3 class="u-text--center"><?php esc_html_e('Contact details', 'ccw_countries') ?>:</h3>

    <?php echo $templates->render('input',
      ['title' => __('Your name', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['contact.name']),
        'attributes' => [
          'id' => 'club[contact_attributes][name]',
          'value' => use_if_set($_POST, ['club', 'contact_attributes', 'name'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>


    <?php echo $templates->render('input',
      ['title' => __('Your email address', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['contact.email']),
        'attributes' => [
          'id' => 'club[contact_attributes][email]',
          'value' =>  use_if_set($_POST, ['club', 'contact_attributes', 'email'], '', 'htmlspecialchars_with_quotes'),
          'required' => '',
          'type' => 'email'
        ]
      ])
    ?>


    <?php
    echo $templates->render('select',
      ['title' => __('Are you a host or a volunteer?', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['can_run_without_volunteer']),
        'options' => array('false' => __('Host', 'ccw_countries'), 'true' => __('Volunteer', 'ccw_countries')),
        'selected' => get_yes_no($_SESSION['club']['can_run_without_volunteer']),
        'include_blank' => '',
        'attributes' => [
          'id' => '',
          'required'=> '',
        ]
      ])
    ?>


    <?php
    echo $templates->render('info', ['message' => __('Your name and email address will never be displayed publicly', 'ccw_countries')]);?>

    <input
      type="hidden"
      id="club[venue_attributes][address_attributes][country_code]"
      name="club[venue_attributes][address_attributes][country_code]"
      value="<?php echo CCW_API_COUNTRY_CODE; ?>" />


    <!-- anti-spam field start -->
    <div style="display: none;">
      <label for="body_text">Keep this field blank</label>
      <input type="text" name="body_text" id="body_text">
    </div>
    <!-- anti-spam field end -->
  </fieldset>


  <fieldset class="c-form__fieldset">
    <h3 class="u-text--center"><?php esc_html_e('Venue details', 'ccw_countries') ?>:</h3>

    <?php echo $templates->render('input',
      ['title' => __('Venue name', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.name']),
        'attributes' => [
          'id' => 'club[venue_attributes][name]',
          'value' => use_if_set($_POST, ['club', 'venue_attributes', 'name'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Venue website', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue']),
        'attributes' => [
          'id' => 'club[venue_attributes][url]',
          'type' => 'url',
          'value' => use_if_set($_POST, ['club', 'venue_attributes', 'url'], '', 'htmlspecialchars_with_quotes'),
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Street address 1', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.address.address-1']),
        'attributes' => [
          'id' => 'club[venue_attributes][address_attributes][address_1]',
          'value' => use_if_set($_POST, ['club', 'venue_attributes', 'address_attributes', 'address_1'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Street address 2', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.address.address-2']),
        'attributes' => [
          'id' => 'club[venue_attributes][address_attributes][address_2]',
          'value' => use_if_set($_POST, ['club', 'venue_attributes', 'address_attributes', 'address_2'], '', 'htmlspecialchars_with_quotes')
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Town / City', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.address.city']),
        'attributes' => [
          'id' => 'club[venue_attributes][address_attributes][city]',
          'value' => use_if_set($_POST, ['club', 'venue_attributes', 'address_attributes', 'city'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>

    <?php echo $templates->render('input',
        ['title' => __('Region / State', 'ccw_countries'),
          'error' => use_if_set($error_messages, ['venue.address.region']),
          'attributes' => [
            'id' => 'club[venue_attributes][address_attributes][region]',
            'value' => use_if_set($_POST, ['club', 'venue_attributes', 'address_attributes', 'region'], '', 'htmlspecialchars_with_quotes')
          ]
        ]);
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Postcode / Zipcode', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.address.postcode']),
        'attributes' => [
          'id' => 'club[venue_attributes][address_attributes][postcode]',
          'value' => use_if_set($_POST, ['club', 'venue_attributes', 'address_attributes', 'postcode'], '', 'htmlspecialchars_with_quotes'),
        ]
      ])
    ?>

    <?php
    echo $templates->render('select',
      ['title' => __('Are you a happy for people to be able to contact your club?', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['happy_to_be_contacted']),
        'options' => array('true' =>  __('Yes', 'ccw_countries'), 'false' =>  __('No', 'ccw_countries')),
        'selected' =>  __('Yes', 'ccw_countries'),
        'attributes' => [
          'id' => 'club[happy_to_be_contacted]',
          'required'=> '',
          'value' => use_if_set($_POST, ['club', 'happy_to_be_contacted'], '', 'htmlspecialchars_with_quotes'),
        ]
      ])
    ?>
    <?php
    echo $templates->render('info', ['message' => __('Selecting yes will allow potential volunteers to contact you.
    This setting can be changed at any time once your account has been created.', 'ccw_countries')]);?>

    <div class="c-form__input-group">
      <input class="c-form__input-group-checkbox" id="terms-checkbox" name="terms-checkbox" type="checkbox" value="true" <?php echo !empty( $_POST['terms-checkbox'] ) ? 'checked="checked"' : ''; ?>>
      <label class="c-form__input-group-label u-text--left" for="terms-checkbox"><?php esc_html_e( 'I accept the', 'ccw_countries' ); ?> <a href="<?php echo CCW_API_TERMS_CONDITIONS_PAGE; ?>" target="_blank"><?php esc_html_e( 'terms &amp; conditions', 'ccw_countries' ); ?></a></label>
    </div>


  </fieldset>

  <p class="u-text--center">
    <button class="c-button c-button--green"
            type="submit"
            id="register-club-submit"
            form="register-club"
            value="Create a Code Club"><?php esc_html_e("Create a Code Club", 'ccw_countries') ?></button>
  </p>

</form>
