<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021 Kai Sassnowski
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ksassnowski/venture
 */

use Sassnowski\Venture\Serializer\DefaultSerializer;
use Sassnowski\Venture\Serializer\UnserializeException;
use Stubs\TestJob1;

it('serializes the object', function (): void {
    $serializer = new DefaultSerializer();
    $job = new TestJob1();

    $result = $serializer->serialize($job);

    expect($result)->toBe(\serialize($job));
});

it('unserializes the object', function (): void {
    $serializer = new DefaultSerializer();
    $job = new TestJob1();

    $result = $serializer->unserialize(\serialize($job));

    expect($result)->toEqual($job);
});

it('throws an exception if the provided string could not be unserialized', function (): void {
    (new DefaultSerializer())->unserialize('::not-a-valid-serialized-string::');
})->throws(UnserializeException::class);
