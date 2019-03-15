// import infiniteScroll from 'infinite-scroll/dist/infinite-scroll.pkgd';

export default {
  init() {
    //
    // $('#loop-wrapper').infiniteScroll({
    //   // options
    //   path: '.next-nav',
    //   append: '.wiki-card',
    //   history: false,
    // });



    if ($('.next-nav').length > 0) {
      var elem = document.querySelector('#loop-wrapper');
      var infScroll = new InfiniteScroll( elem, {
        // options
        path: '.next-nav',
        append: '.wiki-card',
        history: false,
        status: '.scroller-status',
        hideNav: 'ul.uk-pagination',
      });
    }   else {
        $('.infinite-scroll-request').css('display', 'none');
        $('p.infinite-scroll-error').css('display', 'none');
    }



  }
};
