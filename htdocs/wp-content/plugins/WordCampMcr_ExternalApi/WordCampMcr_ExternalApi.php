<?php

/*
  Plugin Name: WordCampMcr_ExternalApi
  Plugin URI:
  Description: Example Application Plugin for WordCamp Manchester talk
  Version: 1.0.0
  Author: Kathryn Reeve <Kathyrn@BinaryKitten.com>
  Author URI: BinaryKitten.com
 */

class WordCampMcr_ExternalApi
{

    function __construct()
    {
        add_filter("template_include", array($this, "process_template_include"));
        add_filter('wp_title', array($this, 'process_title'), 10, 2);
    }

    public function process_template_include($original_template)
    {
        global $wp;
        if (isset($wp->query_vars["name"])) {
            switch ($wp->query_vars['name']) {
                case 'dogecoin':
                    return plugin_dir_path(__FILE__) . "templates/dogecoin.phtml";
                    break;

                case 'bitcoin':
                    return plugin_dir_path(__FILE__) . "templates/bitcoin.phtml";
                    break;

                case 'error-handling':
                    return plugin_dir_path(__FILE__) . 'templates/error.phtml';
                    break;

                default:
                    break;
            }
        }
        return $original_template;
    }

    public function process_title($title, $sep)
    {
        global $wp;

        if (isset($wp->query_vars["name"])) {
            switch ($wp->query_vars['name']) {
                case 'dogecoin':
                    $title = 'DogeCoin ' . $sep . ' External API Example ' . $sep . ' ';
                    break;
                case 'bitcoin':
                    $title = 'BitCointy ' . $sep . ' External API Example ' . $sep . ' ';
                    break;
            }
        }
        return $title;
    }

    public static function getResults()
    {
        global $wp;
        switch ($wp->query_vars['name']) {
            case 'dogecoin':
                $amount = filter_input(INPUT_POST, 'doge_amount', FILTER_DEFAULT, FILTER_SANITIZE_NUMBER_FLOAT);
                if ($amount === null) {
                    return array(
                        'doge_amount' => 'An Invalid amount of',
                        'btc_amount' => 0,
                        'currency_amount' => 0
                    );
                }

                $url1 = sprintf('https://www.dogeapi.com/wow/v2/?a=get_current_price&convert_to=BTC&amount_doge=%f', $amount * 1000);
                $response = wp_remote_get($url1);
                if (!is_wp_error($response)) {
                    $body = wp_remote_retrieve_body($response);
                    $data = json_decode($body);
                    $btcAmount = $data->data->amount;
                    $url2 = sprintf('http://bitcointy.herokuapp.com/convert/%f/GBP', $btcAmount);
                    $response = wp_remote_get($url2);
                    if (!is_wp_error($response)) {
                        $body = wp_remote_retrieve_body($response);
                        $data = json_decode($body);
                        return array(
                            'doge_amount' => $amount,
                            'btc_amount' => $btcAmount,
                            'currency_amount' => ($data->value / 1000)
                        );
                    } else {
                        return $response;
                    }
                } else {
                    return $response;
                }
                break;
            case 'bitcoin':

                $amount = filter_input(INPUT_POST, 'btc_amount', FILTER_DEFAULT, FILTER_SANITIZE_NUMBER_FLOAT);
                if ($amount !== false) {
                    $url = sprintf('http://bitcointy.herokuapp.com/convert/%f/GBP', $amount);
                    $response = wp_remote_get($url);
                    if (!is_wp_error($response)) {
                        $body = wp_remote_retrieve_body($response);
                        $data = json_decode($body);

                        return array(
                            'btc_amount' => $amount,
                            'currency_amount' => $data->value
                        );
                    }
                }
                break;
            case 'error-handling':
                break;
        }
    }

    public static function isSubmitted()
    {
        global $wp;
        if (isset($wp->query_vars["name"])) {
            switch ($wp->query_vars['name']) {
                case 'dogecoin':
                    return (filter_input(INPUT_POST, 'doge_amount', FILTER_DEFAULT, FILTER_SANITIZE_NUMBER_FLOAT) !== null);
                    break;

                case 'bitcoin':
                    return (filter_input(INPUT_POST, 'btc_amount', FILTER_DEFAULT, FILTER_SANITIZE_NUMBER_FLOAT) !== null);
                    break;
            }
        }
        return false;
    }

}

new WordCampMcr_ExternalApi();
