<?php

it('returns a successful response', function () {
    $response = $this->get(route('index'));

    $response->assertStatus(200);
});
