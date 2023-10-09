const dao = require('../Integration/index');


module.exports={
    'user'         : dao.userDAO,
    'agency'       : dao.agencyDAO,
    'agent'        : dao.agentDAO,
    'booking'      : dao.bookingDAO,
    'creditcard'   : dao.creditCardDAO,
    'property'     : dao.propertyDAO,
    'renter'       : dao.renterDAO,
    'neighborhood' : dao.neighborhoodDAO,
    'useraddress'  : dao.user_addressDAO
}