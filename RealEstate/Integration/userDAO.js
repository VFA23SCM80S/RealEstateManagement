const Models= require('../model');

module.exports = {
  
  create: (user) => {
    return Models.User.create(user);
  },

  
  findAll: () => {
    return Models.User.findAll();
  },

  
  find: (id) => {
    return Models.User.findByPk(id);
  },

  
  update: (id, user) => {
    return Models.User.update(user, {
      where: { user_id: id }
    });
  },

  
  delete: (id) => {
    return Models.User.destroy({
      where: { user_id: id }
    });
  }
};
