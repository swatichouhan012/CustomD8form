<?php
/**
 * @file
 * Contains \Drupal\myform\Form\MyForm.
 */
namespace Drupal\myform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MyForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'resume_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['your_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Your Name:'),
      '#required' => TRUE,
    );

    $form['your_email'] = array(
      '#type' => 'email',
      '#title' => t('Your Email ID:'),
      '#required' => TRUE,
    );

    $form['your_number'] = array (
      '#type' => 'tel',
      '#title' => t('Your Mobile no'),
    );

    $form['your_dob'] = array (
      '#type' => 'date',
      '#title' => t('Your DOB'),
      '#required' => TRUE,
    );

    $form['gender'] = array (
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'female' => t('Female'),
        'male' => t('Male'),
      ),
    );

    $form['candidate_confirmation'] = array (
      '#type' => 'radios',
      '#title' => ('Are you above 18 years old?'),
      '#options' => array(
        'Yes' =>t('Yes'),
        'No' =>t('No')
      ),
      '#default_value' => 'No',
    );

    $form['candidate_copy'] = array(
      '#type' => 'checkbox',
      '#title' => t('Send me a copy of the application.'),
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {

      if (strlen($form_state->getValue('your_number')) < 10) {
        $form_state->setErrorByName('your_number', $this->t('Mobile number is too short.'));
      }

    }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

   // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));

    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

   }
}
