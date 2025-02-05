<?php
namespace JMichaelWard\BoardGameCollector\Api\Routes;

use JMichaelWard\BoardGameCollector\Model\Games\BGGGame;
use WebDevStudios\OopsWP\Utility\Registerable;

/**
 * Class Games
 *
 * Modifies the data returned by the default WordPress REST API endpoints.
 *
 * @package BGW\API\Endpoints
 */
class Games implements Registerable {
	/**
	 * Register data fields to return in the standard Games response.
	 */
	public function register() {
		$this->add_meta_to_response();
	}

	/**
	 * Add metadata for each board game to the standard API response.
	 *
	 * @author Jeremy Ward <jeremy@jmichaelward.com>
	 * @since  2019-05-01
	 */
	private function add_meta_to_response() {
		register_rest_field(
			'bgc_game',
			'metadata',
			[
				'get_callback' => function ( $post ) {
					$data = get_post_meta( $post['id'], 'bgc_game_meta', true );

					return is_a( $data, BGGGame::class ) ? $data->get_data() : [];
				},
			]
		);
	}
}
