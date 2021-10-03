<?php

/*
 * This file is part of iamdarkle/PhotoSwipe
 *
 * Copyright (c) 2021 Tomás Romero.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use Flarum\Extend;
use Flarum\Frontend\Document;

return [
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head[] = '<script defer type="text/javascript" src="js/dist/photoswipe.esm.js"></script>';
            $document->head[] = '<script defer type="text/javascript" src="js/dist/photoswipe-lightbox.esm.js"></script>';
            $document->head[] = '<link rel="preload" as="style" href="css/dist/photoswipe.css" onload="this.onload=null;this.rel=\'stylesheet\'">';
            $document->foot[] = <<<HTML
<script>
flarum.core.compat.extend.extend(flarum.core.compat['components/CommentPost'].prototype, 'oncreate', function (output, vnode) {
    const self = this;
    this.$('img').not('.emoji').not(".Avatar").not($(".PostMeta-ip img")).each(function () {
        
        const lightbox = new PhotoSwipeLightbox({
  gallery: '#my-gallery',
  children: 'a',
  pswpModule: PhotoSwipe
});
lightbox.init('.Post-body img:not(.emoji):not(.Avatar):not(.PostMeta-ip img)');


    });
});
</script>
HTML;
        })
];