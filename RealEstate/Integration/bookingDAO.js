const { Booking } = require('../model'); // import the Booking model

module.exports = {
  // create a new booking
  create: async (bookingData) => {
    try {
      const booking = await Booking.create(bookingData);
      return booking.toJSON(); // return the JSON representation of the created booking
    } catch (error) {
      throw new Error(error);
    }
  },

  // find all bookings
  findAll: async () => {
    try {
      const bookings = await Booking.findAll();
      return bookings.map((booking) => booking.toJSON()); // return an array of JSON representations of the bookings
    } catch (error) {
      throw new Error(error);
    }
  },

  // find a booking by id
  find: async (id) => {
    try {
      const booking = await Booking.findByPk(id);
      return booking ? booking.toJSON() : null; // return the JSON representation of the booking if found, otherwise null
    } catch (error) {
      throw new Error(error);
    }
  },

  // delete a booking by id
  delete: async (id) => {
    try {
      const booking = await Booking.destroy({ where: { id } });
      return booking; // return the number of deleted rows (should be 1)
    } catch (error) {
      throw new Error(error);
    }
  },

  // update a booking by id
  update: async (id, bookingData) => {
    try {
      const booking = await Booking.findByPk(id);
      if (!booking) {
        return null; // if booking not found, return null
      }
      const updatedBooking = await booking.update(bookingData);
      return updatedBooking.toJSON(); // return the JSON representation of the updated booking
    } catch (error) {
      throw new Error(error);
    }
  },
};
