export default class {

    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.role === 'admin';
    }
    isUser() {
        return this.user.role === 'user';
    }
    isAdminOrPlanner() {
        if (this.user.role === 'admin' || this.user.role === 'planner') {
            return true;
        }
    }
    isAdminOrUser() {
        if (this.user.role === 'admin' || this.user.role === 'user') {
            return true;
        }
    }

    isPlannerORUser() {
        if (this.user.role === 'planner' || this.user.role === 'user') {
            return true;
        }
    }
}