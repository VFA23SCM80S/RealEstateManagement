const Agent = require('../model').Agent;

module.exports = {
  create: (agentData) => {
    return Agent.create(agentData);
  },

  findAll: () => {
    return Agent.findAll();
  },

  find: (agentId) => {
    return Agent.findByPk(agentId);
  },

  update: (agentId, agentData) => {
    return Agent.update(agentData, {
      where: { AgentID: agentId }
    });
  },

  delete: (agentId) => {
    return Agent.destroy({
      where: { AgentID: agentId }
    });
  }
};
