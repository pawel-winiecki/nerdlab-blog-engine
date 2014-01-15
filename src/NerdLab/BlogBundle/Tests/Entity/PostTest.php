<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Tests\Entity;

use NerdLab\BlogBundle\Entity\Post;

/**
 * Description of PostTest
 *
 * @author Paweł Winiecki, http://nerdlab.pl
 */
class PostTest extends \PHPUnit_Framework_TestCase {

    public function testGenerateLinkFromTitle() {
        $post = new Post();

        $post->setTitle(' Zażółć - Gęślą Jaźń---Zażółć gęślą jaźń!? t!e@s#T$o%w^a&n*i(e)');

        $this->assertEquals('zazolc-gesla-jazn-zazolc-gesla-jazn-testowanie', $post->generateLinkFromTitle());
    }

}
