'use strict';

/**
 * A set of functions called "actions" for `User`
 */

module.exports = {
  /**
   * Get user entries.
   *
   * @return {Object|Array}
   */

  find: function * () {
    try {
      this.body = yield strapi.services.user.fetchAll(this.query);
    } catch (err) {
      this.body = err;
    }
  },

  /**
   * Get a specific user.
   *
   * @return {Object|Array}
   */

  findOne: function * () {
    try {
      this.body = yield strapi.services.user.fetch(this.params)
    } catch (err) {
      this.body = err;
    }
  },

  /**
   * Create a/an user entry.
   *
   * @return {Object}
   */

  create: function * () {
    try {
      this.body = yield strapi.services.user.add(this.request.body);
    } catch (err) {
      this.body = err;
    }
  },

  /**
   * Update a/an user entry.
   *
   * @return {Object}
   */

  update: function * () {
    try {
      this.body = yield strapi.services.user.edit(this.params, this.request.body) ;
    } catch (err) {
      this.body = err;
    }
  },

  /**
   * Destroy a/an user entry.
   *
   * @return {Object}
   */

  destroy: function * () {
    try {
      this.body = yield strapi.services.user.remove(this.params);
    } catch (err) {
      this.body = err;
    }
  },

  /**
   * Add relation to a specific user.
   *
   * @return {Object}
   */

  createRelation: function * () {
    try {
      this.body = yield strapi.services.user.addRelation(this.params, this.request.body);
    } catch (err) {
      this.status = 400;
      this.body = err;
    }
  },

  /**
   * Update relation to a specific user.
   *
   * @return {Object}
   */

  updateRelation: function * () {
    try {
      this.body = yield strapi.services.user.editRelation(this.params, this.request.body);
    } catch (err) {
      this.status = 400;
      this.body = err;
    }
  },

  /**
   * Destroy relation to a specific user.
   *
   * @return {Object}
   */

  destroyRelation: function * () {
    try {
      this.body = yield strapi.services.user.removeRelation(this.params, this.request.body);
    } catch (err) {
      this.status = 400;
      this.body = err;
    }
  }
};
