<?php

test('The application returns a successful response')
    ->get('/')
    ->assertStatus(200);
