<?php

namespace Drupal\weather_example\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class WeatherController.
 */
class WeatherController extends ControllerBase
{

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
    public function weather()
    {
        return [
      '#type' => 'markup',
      '#markup' => $this->t('<p>Current weather below.</p><div id="weathercss">'. $this->weatherRes() .'</div>'),
      '#allowed_tags' => ['p,div'],
    ];
    }

    public function weatherRes()
    {
        $data = file_get_contents('https://api.weatherapi.com/v1/current.json?key=ce2e3f9f09eb41b08a9180248201311&q=19968');
        $w = json_decode($data, true);

        return '<p>The current temperature for '.$w['location']['name'].',
        '.$w['location']['region'].' is '.$w['current']['temp_f'].'F. Wind direction
        is '.$w['current']['wind_dir'].' at '.$w['current']['wind_mph'].' MPH.</p>
        <h3>Condition: '.$w['current']['condition']['text'].'</h3><p><img src="'.$w['current']['condition']['icon'].'"></p>';
    }
}
