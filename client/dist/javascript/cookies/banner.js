var cookieBanner = document.querySelector('.idsk-cookie-banner');
var cookieBannerAccepted = document.querySelector('.js-cookie-banner-accepted');
var cookieBannerRejected = document.querySelector('.js-cookie-banner-rejected');
var cookieMessage = document.querySelector('.idsk-cookie-banner__message');
var acceptButton = document.querySelector('.js-cookies-button-accept');
var rejectButton = document.querySelector('.js-cookies-button-reject');
var acceptedButtonHide = document.querySelector('.js-cookies-button-accepted-hide');
var rejectedButtonHide = document.querySelector('.js-cookies-button-rejected-hide');

if (cookieBanner) {
  cookieBanner.hidden = (window.localStorage.getItem('acceptedCookieBanner') === 'true');

  acceptButton.addEventListener('click', function (event) {
    cookieMessage.hidden = true;
    cookieBannerAccepted.hidden = false;
    window.localStorage.setItem('googleAnalytics', 'true');
    window.localStorage.setItem('acceptedCookieBanner', 'true');
    event.preventDefault();
  });

  rejectButton.addEventListener('click', function (event) {
    cookieMessage.hidden = true;
    cookieBannerRejected.hidden = false;
    window.localStorage.setItem('googleAnalytics', 'false');
    window.localStorage.setItem('acceptedCookieBanner', 'true');
    event.preventDefault();
  });

  acceptedButtonHide.addEventListener('click', function (event) {
    cookieBanner.hidden = true;
    event.preventDefault();
  });

  rejectedButtonHide.addEventListener('click', function (event) {
    cookieBanner.hidden = true;
    event.preventDefault();
  });
}
