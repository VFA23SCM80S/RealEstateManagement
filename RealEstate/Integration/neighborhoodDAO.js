const Models = require("../model");

module.exports = {
  create: async (neighborhood) => {
    try {
      const result = await Models.Neighborhood.create(neighborhood);
      return result;
    } catch (err) {
      throw new Error(err.message);
    }
  },

  findAll: async () => {
    try {
      const result = await Models.Neighborhood.findAll();
      return result;
    } catch (err) {
      throw new Error(err.message);
    }
  },

  find: async (id) => {
    try {
      const result = await Models.Neighborhood.findByPk(id);
      return result;
    } catch (err) {
      throw new Error(err.message);
    }
  },

  update: async (id, neighborhood) => {
    try {
      let result = await Models.Neighborhood.finModelsyPk(id);
      if (result) {
        result = await result.update(neighborhood);
        return result;
      } else {
        throw new Error("Neighborhood not found");
      }
    } catch (err) {
      throw new Error(err.message);
    }
  },

  delete: async (id) => {
    try {
      const result = await Models.Neighborhood.destroy({ where: { id } });
      if (result === 0) {
        throw new Error("Neighborhood not found");
      } else {
        return result;
      }
    } catch (err) {
      throw new Error(err.message);
    }
  },
};
