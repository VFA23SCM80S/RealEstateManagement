const Models = require('../model');

module.exports = {
  create: (propertyData) => {
    return Models.Property.create(propertyData);
  },

  findAll: () => {
    return Models.Property.findAll();
  },

  findById: (id) => {
    return Models.Property.findByPk(id);
  },

  update: (id, propertyData) => {
    return Models.Property.update(propertyData, {
      where: { id },
      returning: true
    });
  },

  delete: (id) => {
    return Models.Property.destroy({ where: { id } });
  }
};
