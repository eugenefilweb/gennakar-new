<?php

namespace app\widgets;

use app\helpers\ArrayHelper;
use app\helpers\Html;
use app\helpers\App;

class TwitterSearch extends BaseWidget
{
    public $url = 'https://api.twitter.com/2/tweets/search/recent';
    public $api_key = 'pp32rwYKEpAgqaeyBzKgy9y15';
    public $api_key_secret = 'WTR8V6CIbL3U90HNrmWIS3DwEKm64mh2A8mFQvyOC830bSw0s1';
    public $bearer_token = 'AAAAAAAAAAAAAAAAAAAAAGRniwEAAAAApWFvSIeBliUolVPsdJWkvplmJGw%3DzoXSzYkQ14T8M6x5baJzfTZozKyUag9uVquLAipG3kpceBZqY2';
    public $access_token = '1587690232836632577-Oa820fHuBxVeZt8qQkbebQLQ9zdTeB';
    public $access_token_secret = '8N9zASUNRGfCfJKSgB8kuLYRi3aeMAMipwmSM8WdvPzn3';

    public $query = '#EarthquakeQuezon';
    public $data = [];

    public $formattedData = [];

    // tweet.fields
    public $tweetFields = [
        'attachments',
        'author_id',
        'context_annotations',
        'conversation_id',
        'created_at',
        'edit_controls',
        'edit_history_tweet_ids',
        'entities',
        'geo',
        'id',
        'in_reply_to_user_id',
        'lang',
        'possibly_sensitive',
        'public_metrics',
        'referenced_tweets',
        'reply_settings',
        'source',
        'text',
        'withheld'
    ];

    // expansions
    public $expansions = [
        'attachments.media_keys',
        'attachments.poll_ids',
        'author_id',
        'edit_history_tweet_ids',
        'entities.mentions.username',
        'geo.place_id',
        'in_reply_to_user_id',
        'referenced_tweets.id',
        'referenced_tweets.id.author_id'
    ];

    public $mediaFields = [
        'media_key',
        'type',
        'url',
    ];

    public $userFields = [
        'id',
        'name',
        'username',
        'profile_image_url',
        'url',
    ];

    public $height = '700px';
    public $max_results = 50;
    public $ignoreRetweet = true;

    public function init()
    {
        parent::init();
        $this->generateUrl();
        $this->data = $this->jwt_request();

        $mediaList = isset($this->data['includes']['media'])? 
            ArrayHelper::index($this->data['includes']['media'], 'media_key'): [];
        $userList = isset($this->data['includes']['users'])? 
            ArrayHelper::index($this->data['includes']['users'], 'id'): [];

        $formattedData = [];

        if ($this->data && isset($this->data['data'])) {
            foreach ($this->data['data'] as $data) {
              
                $medias = [];
                if (($media_keys = $data['attachments']['media_keys'] ?? null) != null) {
                    foreach ($media_keys as $mk) {
                        if (($media = $mediaList[$mk] ?? null) != null) {
                            $medias[] = $media;
                        }
                    }
                }

                $formatted_text = $data['text'];
                $tagUrls = [];
                if (($urls = $data['entities']['urls'] ?? null) != null) {

                    foreach ($urls as $url) {
                        $formatted_text = str_replace(
                            $url['url'], 
                            '', 
                            $formatted_text
                        );

                        $tagUrls[] = Html::tag('div', Html::a($url['display_url'], $url['url'], [
                            'title' => $url['expanded_url'],
                            'target' => '_blank'
                        ]));
                    }
                }

                $hashtags = [];
                $tagLinks = [];
                if (($tags = $data['entities']['hashtags'] ?? null) != null) {
                    foreach ($tags as $tag) {
                        $formatted_text = str_replace(
                            "#{$tag['tag']}", 
                            '', 
                            $formatted_text
                        );

                        $tagLinks[] = Html::a("#{$tag['tag']}", "https://twitter.com/hashtag/{$tag['tag']}", [
                            'target' => '_blank'
                        ]);
                    }
                    $hashtags = array_keys(ArrayHelper::index($tags, 'tag'));
                }

                $formatted_text = implode('', [
                    implode(' ', $tagLinks),
                    nl2br($formatted_text),
                    implode(' ', $tagUrls),
                ]);

                $author = $userList[$data['author_id']] ?? [];

                $array = [
                    'link' => "https://twitter.com/{$author['username']}/status/{$data['id']}",
                    'hashtags' => $hashtags,
                    'text' => $formatted_text,
                    'urls' => $urls,
                    'author' => $author,
                    'medias' => $medias ?: [],
                    'created_at' => $data['created_at']
                ];

                $formattedData[] = $array;
            }
        }

        $this->formattedData = $formattedData;
    }

    public function generateUrl()
    {
        $query = $this->query;
        if ($this->ignoreRetweet) {
            $query .= " -is:retweet";
        }

        $params = [
            'query' => $query,
            'tweet.fields' => implode(',', $this->tweetFields),
            'expansions' => implode(',', $this->expansions),
            'media.fields' => implode(',', $this->mediaFields),
            'user.fields' => implode(',', $this->userFields),
            'max_results' => $this->max_results
        ];

        $this->url = implode('?', [
            $this->url,
            http_build_query($params)
        ]);
    }


    public function jwt_request() 
    {
        header('Content-Type: application/json'); // Specify the type of data
        $ch = curl_init($this->url); // Initialise cURL
        $authorization = "Authorization: Bearer ".$this->bearer_token; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        $result = curl_exec($ch); // Execute the cURL statement
        curl_close($ch); // Close the cURL connection
        return ArrayHelper::objectToArray(json_decode($result)); // Return the received data
    }


    // https://api.twitter.com/2/tweets/search/recent?query=%23EarthquakeQuezon&tweet.fields=attachments,author_id,context_annotations,conversation_id,created_at,edit_controls,edit_history_tweet_ids,entities,geo,id,in_reply_to_user_id,lang,non_public_metrics,organic_metrics,possibly_sensitive,promoted_metrics,public_metrics,referenced_tweets,reply_settings,source,text,withheld&expansions=attachments.media_keys,attachments.poll_ids,author_id,edit_history_tweet_ids,entities.mentions.username,geo.place_id,in_reply_to_user_id,referenced_tweets.id,referenced_tweets.id.author_id" -H "Authorization: Bearer $BEARER_TOKEN

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render("twitter-search", [
            'data' => $this->data,
            'formattedData' => $this->formattedData,
            'height' => $this->height,
            'query' => $this->query,
        ]);
    }
}
