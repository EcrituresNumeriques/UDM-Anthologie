'use strict';

/**
 * New migration information
 *
 * Warning: this migration has been automatically generated. We strongly advise
 * you to manually verify those information.
 */

exports.up = function(connection, Promise) {

  return Promise.all([

  ]);

};

/**
 * How to rollback this migration
 *
 * Warning: this rollback has been automatically generated. We strongly advise
 * you to manually verify those information.
 */

exports.down = function(connection, Promise) {

  return Promise.all([

  ]);

};

/**
 * Migration's config
 */

exports.config = {

  /**
   * Transactions are an important feature of relational databases, as they allow
   * correct recovery from failures and keep a database consistent even in cases of
   * system failure. All queries within a transaction are executed on the same
   * database connection, and run the entire set of queries as a single unit of work.
   * Any failure will mean the database will rollback any queries executed on that
   * connection to the pre-transaction state.
   * By default, each migration is run inside a transaction.
   */

  transaction: true
};
