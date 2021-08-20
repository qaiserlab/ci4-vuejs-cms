$('.ui-dropdown .dropdown-item').on('click', (e) => {
  const href = $(e.currentTarget).attr('href');
  window.location = href;
});

$(() => {
  $(window).scroll((event) => {
    let selector = '#navbar > .container';

    if ($(event.currentTarget).scrollTop() <= 16)
      $(selector).slideDown();
    else
      $(selector).slideUp();
  });
});