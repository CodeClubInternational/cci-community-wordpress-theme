<form class="c-form"
      id="update-club-details"
      method="POST">

  <?php
    // The form uses a honeypot field called "body_text", purposefully named so as to not be obvious to spam bots
    $error_messages = array();
    $templates = new League\Plates\Engine(get_template_directory() . '/template-parts/shared');

    $club_session = new Club_Session();
    $club_session->redirectIfNoSession();

    if (empty($_POST['body_text']) && !empty($_POST['club'])) {

      $club_json = strip_slashes_json_encode($_POST);
      $ccw_api   = new CCW_API();
      $response  = $ccw_api->updateClub($club_json);

      $error_messages = react_to_response($response, 200, function ($response) {
        $_POST = array();
        $club = json_decode( wp_remote_retrieve_body( $response ), true );
        $_SESSION['club'] = $club;
        $flash_messages = new Flash_Message();
        $flash_messages->createSuccess(__("Successfully edited!", 'ccw_countries'));
        wp_safe_redirect('/account');
        exit;
      });

    }
  ?>


  <fieldset class="c-form__fieldset">
    <h3 class="u-text--center"><?php esc_html_e("Contact details", 'ccw_countries'); ?></h3>

    <?php echo $templates->render('input',
      ['title' => __('Your name', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['contact.name']),
        'attributes' => [
          'id' => 'club[contact_attributes][name]',
          'value' => use_if_set($_SESSION, ['club', 'contact', 'name'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Your email address', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['contact.email']),
        'attributes' => [
          'id' => 'club[contact_attributes][email]',
          'value' =>  use_if_set($_SESSION, ['club', 'contact', 'email'], '', 'htmlspecialchars_with_quotes'),
          'type' => 'email',
          'required' => ''
        ]
      ])
    ?>

    <?php echo $templates->render('info', ['message' => __("Your name and email address will never be displayed publicly", 'ccw_countries')]);?>

  </fieldset>

  <?php echo $templates->render('keep-blank-field'); ?>

  <?php echo $templates->render('input',
    [ 'attributes' => [
      'id' => 'auth_token',
      'type' => 'hidden',
      'value' => use_if_set($_SESSION, ['club', 'auth_token'], '', 'htmlspecialchars_with_quotes')
    ]
    ])
  ?>

  <?php echo $templates->render('input',
    [ 'attributes' => [
        'id' => 'username',
        'type' => 'hidden',
        'value' => use_if_set($_SESSION, ['club', 'username'], '', 'htmlspecialchars_with_quotes')
      ]
    ])
  ?>

  <fieldset class="c-form__fieldset">
    <h3 class="u-text--center"><?php esc_html_e('Venue details', 'ccw_countries'); ?></h3>

    <?php echo $templates->render('input',
      ['title' => __('Venue name', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.name']),
        'attributes' => [
          'id' => 'club[venue_attributes][name]',
          'value' => use_if_set($_SESSION, ['club', 'venue', 'name'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>

    <?php
    if (!$club['can_run_without_volunteer']) {
      echo $templates->render('select',
        ['title' => __('Looking for Volunteer', 'ccw_countries'),
          'error' => use_if_set($error_messages, ['looking_for_volunteer']),
          'options' => array('true' => 'Yes', 'false' => 'No'),
          'selected' => get_yes_no($_SESSION['club']['looking_for_volunteer']),
          'attributes' => [
            'id' => 'club[looking_for_volunteer]',
          ]
        ]);
    }
    ?>

    <?php
     echo $templates->render('select',
      ['title' => __('Happy to be contacted', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['happy_to_be_contacted']),
        'options' => array('true' => 'Yes', 'false' => 'No'),
        'selected' => get_yes_no($_SESSION['club']['happy_to_be_contacted']),
        'attributes' => [
          'id' => 'club[happy_to_be_contacted]',
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Venue website', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.url']),
        'attributes' => [
          'id' => 'club[venue_attributes][url]',
          'type' => 'url',
          'value' => use_if_set($_SESSION, ['club', 'venue', 'url'], '', 'htmlspecialchars_with_quotes'),
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Street address 1', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.address.address-1']),
        'attributes' => [
          'id' => 'club[venue_attributes][address_attributes][address_1]',
          'value' => use_if_set($_SESSION, ['club', 'venue', 'address', 'address_1'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Street address 2', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.address.address-2']),
        'attributes' => [
          'id' => 'club[venue_attributes][address_attributes][address_2]',
          'value' => use_if_set($_SESSION, ['club', 'venue', 'address', 'address_2'], '', 'htmlspecialchars_with_quotes')
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Town / City', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.address.city']),
        'attributes' => [
          'id' => 'club[venue_attributes][address_attributes][city]',
          'value' => use_if_set($_SESSION, ['club', 'venue', 'address', 'city'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Region / State', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.address.region']),
        'attributes' => [
          'id' => 'club[venue_attributes][address_attributes][region]',
          'value' => use_if_set($_SESSION, ['club', 'venue', 'address', 'region'], '', 'htmlspecialchars_with_quotes')
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Postcode / Zipcode', 'ccw_countries'),
        'error' => use_if_set($error_messages, ['venue.address.postcode']),
        'attributes' => [
          'id' => 'club[venue_attributes][address_attributes][postcode]',
          'value' => use_if_set($_SESSION, ['club', 'venue', 'address', 'postcode'], '', 'htmlspecialchars_with_quotes'),
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => "Skype", 'ccw_countries'),
        'error' =>  use_if_set($error_messages, ['contact.skype']),
        'attributes' => [
          'id' => 'club[contact_attributes][skype]',
          'value' => use_if_set($_SESSION, ['club', 'contact', 'skype'], '', 'htmlspecialchars_with_quotes'),
        ]
      ])
    ?>
  </fieldset>

  <?php echo $templates->render('submit-button',
    [
      'attributes' => [
        'id' => 'update-club-submit',
        'form' => 'update-club-details',
        'value' => 'Update Club'
      ]
    ])
  ?>

</form>
