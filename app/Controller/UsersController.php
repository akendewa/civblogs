<?php
/**
 * Controlleur pour les utilisateurs.
 *
 * Gere l'activite relative aux utilisateurs.
 *
 * @copyright     Copyright 2012, Akendewa. (http://www.akendewa.org)
 * @author        Regis Bamba (regis.bamba@gmail.com)
 * @package       app.Controller
 * @since         v 0.1.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');
App::uses('Inflector', 'Utility');
App::uses('String', 'Utility');
App::uses('HttpSocket', 'Network/Http');
App::import('Vendor', 'HttpSocketOauth');

class UsersController extends AppController {

    public function twitter_login() {
        $oauthCallback = FULL_BASE_URL.(isset($this->request->{'base'}) ? $this->request->{'base'} : '').'/users/twitter_auth';
        $twitterConsumerKey = Configure::read('Twitter.ConsumerKey');
        $twitterConsumerSecret = Configure::read('Twitter.ConsumerSecret');
        $oauth = new HttpSocketOauth();

        $request = array(
            'uri' => array(
                'scheme' => 'https',
                'host' => 'api.twitter.com',
                'path' => '/oauth/request_token',
            ),
            'method' => 'POST',
            'auth' => array(
                'method' => 'OAuth',
                'oauth_consumer_key' => $twitterConsumerKey,
                'oauth_consumer_secret' => $twitterConsumerSecret,
                'oauth_callback' => $oauthCallback
            ),
        );
        
        $response = $oauth->request($request);
        if (isset($response->code) && $response->code == '200') {
            parse_str($response->body, $response);
            $this->Session->write('Twitter.oauth_token', $response['oauth_token']);
            $this->Session->write('Twitter.oauth_token_secret', $response['oauth_token_secret']);
            $this->redirect('https://api.twitter.com/oauth/authenticate?oauth_token='.$response['oauth_token']);
        } else {
            $this->Session->setFlash(__('We could not connect to Twitter. Please try again.'), 'default', array('class' => 'alert alert-error'));
        }
    }
    
    public function twitter_auth() {
        $oauthToken = $this->params->query['oauth_token'];
        $oauthVerifier = $this->params->query['oauth_verifier'];


        $twitterConsumerKey = Configure::read('Twitter.ConsumerKey');
        $twitterConsumerSecret = Configure::read('Twitter.ConsumerSecret');
        $oauth = new HttpSocketOauth();

        $request = array(
            'uri' => array(
                'scheme' => 'https',
                'host' => 'api.twitter.com',
                'path' => '/oauth/access_token'
            ),
            'method' => 'POST',
            'auth' => array(
                'method' => 'OAuth',
                'oauth_consumer_key' => $twitterConsumerKey,
                'oauth_consumer_secret' => $twitterConsumerSecret,
                'oauth_verifier' => $oauthVerifier,
				'oauth_token' => $oauthToken
            ),
        );

        $response = $oauth->request($request);
		if ($response->code == '200') {
			parse_str($response, $response);
						
			$request = array(
				'uri' => array(
					'scheme' => 'https',
					'host' => 'api.twitter.com',
					'path' => '/1/account/verify_credentials.json'
				),
				'method' => 'GET',
				'auth' => array(
					'method' => 'OAuth',
					'oauth_consumer_key' => $twitterConsumerKey,
					'oauth_consumer_secret' => $twitterConsumerSecret,
					'oauth_token' => $response['oauth_token'],
					'oauth_token_secret' => $response['oauth_token_secret']
				),
			);
			
			$response = $oauth->request($request);
			
			if ($response->code == '200') {
				$data = json_decode($response);
                $user = $this->User->findByTwitterId($data->id);

                if (empty($user)) {
                    $newUserData = array();
                    $newUserData['twitter_id'] = $data->id;
                    $newUserData['twitter_screen_name'] = $data->screen_name;
                    $newUserData['twitter_name'] = $data->name;
                    $newUserData['twitter_profile_image_url'] = $data->profile_image_url;
                    $newUserData['is_admin'] = false;
                    $newUserData['twitter_followers_count'] = $data->followers_count;
                    $newUserData['twitter_friends_count'] = $data->friends_count;
                    $newUserData['twitter_description'] = $data->description;
                    $newUserData['twitter_url'] = $data->url;
                    $newUserData['twitter_location'] = $data->location;
                    $user = $this->User->create($newUserData);
                } else {
                    $this->User->id = $user['User']['id'];
                }

                $this->User->save();
                $this->Session->write('Auth.User', $user);
                $this->redirect(array('controller' => 'application', 'action' => 'index'));
			}
						
		} else {
			$this->Session->setFlash(__('We could not connect to Twitter. Please try again.'), 'default', array('class' => 'alert alert-error'));
		}
    }


	public function logout() {        
        $this->Session->destroy();
        $this->Session->renew();
        $this->Session->setFlash(__('You have been logged out'), 'default', array('class' => 'alert alert-success'));
        $this->redirect('/');
	}

	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

}
