const CreditCard = require('../model').CreditCard;


module.exports = {
    create: async (row) => {
      const result = await CreditCard.create({
        card_number: row[0],
        card_name: row[1],
        expiration_date: row[2],
        cvv: row[3]
      });
      return result;
    },
    findAll: async () => {
      const result = await CreditCard.findAll();
      return result;
    },
    find: async (id) => {
      const result = await CreditCard.findByPk(id);
      return result;
    },
    delete: async (id) => {
      const result = await CreditCard.destroy({
        where: {
          card_id: id
        }
      });
      return result;
    },
    update: async (id, row) => {
      const result = await CreditCard.findByPk(id);
      if (result) {
        await result.update({
          card_number: row[0],
          card_name: row[1],
          expiration_date: row[2],
          cvv: row[3]
        });
      }
      return result;
    }
  };