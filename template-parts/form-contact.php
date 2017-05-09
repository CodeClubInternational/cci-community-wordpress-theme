<?php

  $code_club = null;
  $templates = new League\Plates\Engine(get_template_directory() . '/template-parts/shared');

  $host_volunteer_matching = new Host_Volunteer_Matching();
  $code_club = $host_volunteer_matching->getCodeClub($_GET['club_id']);

  if (!empty($_POST['message_body'])) {

    $message = $_POST['message_body'] . __(' Please reply to ', 'ccw_countries') . $_POST['contact-name'] . ' (' . $_POST['contact-email'] . ')';

    $email_title = __('Volunteer has contacted you.', 'ccw_countries');

    wp_mail($code_club['contact']['email'],
            $email_title,
            $message);

    $flash_message = new Flash_Message();
    $flash_message->createSuccess(__('Email has been sent', 'ccw_countries'));
  }

?>

<div class="c-content-panel">
  <h2 class="u-text--center">
    <?php echo $code_club['venue']['name']; ?><br>
    <span class="c-meta">
      <?php echo $code_club['venue']['address']['address_1'] . ' ' .
                 $code_club['venue']['address']['address_2'] . ' ' .
                 $code_club['venue']['address']['city'] . ' ' .
                 $code_club['venue']['address']['postcode'];; ?>
    </span>
  </h2>

  <form class="c-form" id="contact" action="#" method="POST">

    <?php echo $templates->render('input',
      ['title' => __('Your name', 'ccw_countries'),
        'attributes' => [
          'id' => 'contact-name',
          'value' => use_if_set($_POST, ['contact-name'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>

    <?php echo $templates->render('input',
      ['title' => __('Your email address', 'ccw_countries'),
        'attributes' => [
          'id' => 'contact-email',
          'value' => use_if_set($_POST, ['contact-email'], '', 'htmlspecialchars_with_quotes'),
          'required' => ''
        ]
      ])
    ?>

    <label class="c-form__label" for="message_body">
      <?php esc_html_e('Message', 'ccw_countries'); ?>
      <span class="c-form__optional"><?php esc_html_e('(required)', 'ccw_countries'); ?></span>
    </label>
    <textarea class="c-form__textarea" cols="30" id="message_body" name="message_body" required="required" rows="10"></textarea>


   <?php echo $templates->render('submit-button',
        [
          'title' => __("Send Message", 'ccw_countries'),
          'attributes' => [
            'id' => 'contact-submit',
            'form' => 'contact'
          ]
        ]) ?>

  </form>

</div>
