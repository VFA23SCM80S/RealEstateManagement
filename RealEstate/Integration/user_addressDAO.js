const User_Address = require('../model').User_Address;

module.exports = {
  create: async (address) => {
    try {
      const user_address = await User_Address.create({
        address: address.address,
        city: address.city,
        state: address.state,
        country: address.country,
        zip_code: address.zip_code,
        user_id: address.user_id
      });
      return user_address;
    } catch (error) {
      throw new Error(error.message);
    }
  },

  findAll: async () => {
    try {
      const user_addresses = await User_Address.findAll();
      return user_addresses;
    } catch (error) {
      throw new Error(error.message);
    }
  },

  find: async (id) => {
    try {
      const user_address = await User_Address.findByPk(id);
      return user_address;
    } catch (error) {
      throw new Error(error.message);
    }
  },

  update: async (id, address) => {
    try {
      const user_address = await User_Address.findByPk(id);
      if (!user_address) throw new Error("User address not found!");
      await user_address.update({
        address: address.address,
        city: address.city,
        state: address.state,
        country: address.country,
        zip_code: address.zip_code,
        user_id: address.user_id
      });
      return user_address;
    } catch (error) {
      throw new Error(error.message);
    }
  },

  delete: async (id) => {
    try {
      const user_address = await User_Address.findByPk(id);
      if (!user_address) throw new Error("User address not found!");
      await user_address.destroy();
      return user_address;
    } catch (error) {
      throw new Error(error.message);
    }
  }
};
