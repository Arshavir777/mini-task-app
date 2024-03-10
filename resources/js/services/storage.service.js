class StorageService {
  save(key, data) {
    localStorage.setItem(key, JSON.stringify(data));
  }

  get(key) {
    const data = localStorage.getItem(key);
    return data ? JSON.parse(data) : null;
  }

  remove(key) {
    localStorage.removeItem(key);
  }

  clear() {
    this.remove('draftCustomer');
    this.remove('lastStep');
  }

  checkDraftCustomer = (customerId) => {
    const draftCustomer = this.get('draftCustomer');
    if (draftCustomer?.id === customerId) {
      this.clear();
    }
  };
}

export default new StorageService();
