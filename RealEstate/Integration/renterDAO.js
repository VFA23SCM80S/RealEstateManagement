const Models= require('../model');

module.exports = {
  create: (renter) => Models.Renter.create(renter),

  findAll: () => Models.Renter.findAll(),
  
  find: (id) => Models.Renter.findByPk(id),
  
  update: (id, renter) =>
  Models.Renter.update(renter, {
      where: { id },
    }),
  
    delete: (id) =>
    Models.Renter.destroy({
        where: { id },
    }),
};
