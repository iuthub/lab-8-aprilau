<?php

namespace App;


class PostsRepo {
	private $session;

	public function __construct($session) {
		$this->session=$session;

		if(!$this->session->has('posts')) {
			$this->init();
		}
	}

	public function init() {
		$posts = [];

		for($i=0;$i<3;$i++) {
			$post = [
				'title' => 'Sample Post ' . $i,
				'body' => 'Some text'

			];
			array_push($posts, $post);
		}

		$this->session->put('posts', $posts);
	}

	public function getPosts() {
		return $this->session->get('posts');
	}

	public function getPost( $id) {
		return $this->session->get('posts')[$id];
	}

	public function getPostByTitle($title) {
		$posts=$this->session->get('posts');
		foreach($posts as $post) {
			if($post['title']==$title) return $post;
		}
		return null;
	}

	public function addPost($title, $body) {
		$posts = $this->session->get('posts');
		array_push($posts, [
			'title' => $title,
			'body' => $body
		]);

		$this->session->put('posts', $posts);
	}

	public function updatePost($id, $title, $body) {
		$posts = $this->session->get('posts');
		$posts[$id] = [
			'title' => $title,
			'body' => $body
		];

		$this->session->put('posts', $posts);
	}

	public function deletePost($id) {
		$posts = $this->session->get('posts');

		unset($posts[$id]);

		$this->session->put('posts', $posts);
	}

}

?>