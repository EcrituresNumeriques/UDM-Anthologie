'use strict';

/**
 * `isAuthenticated` policy.
 */

exports.isAuthenticated = function * (next) {

  let isAuthenticated = false;

  // Get and verify JWT via service.
  try {
    const user = yield strapi.api.user.services.jwt.getToken(this, true);

    // We delete the token from query and body to not mess.
    this.request.query && delete this.request.query.token;
    this.request.body && delete this.request.body.token;

    // User is authenticated.
    isAuthenticated = true;
  } catch (error) {
    // User is not authenticated.
    isAuthenticated = false;
  }

  if (!isAuthenticated) {
    this.status = 401;
    return this.body = {
      message: 'You are not allowed to perform this action.'
    };
  } else {
    yield next;
  }
};
