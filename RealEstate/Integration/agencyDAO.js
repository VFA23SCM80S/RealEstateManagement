const Models = require('../model');

module.exports = {
  create: async (data) => {
    try {
      const result = await Models.Agency.create(data);
      return result;
    } catch (error) {
      throw new Error(error.message);
    }
  },

  findAll: async () => {
    try {
      const results = await Models.Agency.findAll();
      return results;
    } catch (error) {
      throw new Error(error.message);
    }
  },

  find: async (id) => {
    try {
      const result = await Models.Agency.findOne({
        where: { id },
      });
      return result;
    } catch (error) {
      throw new Error(error.message);
    }
  },

  update: async (id, data) => {
    try {
      const result = await Models.Agency.update(data, {
        where: { id },
      });
      return result;
    } catch (error) {
      throw new Error(error.message);
    }
  },

  delete: async (id) => {
    try {
      const result = await Models.Agency.destroy({
        where: { id },
      });
      return result;
    } catch (error) {
      throw new Error(error.message);
    }
  },
};
