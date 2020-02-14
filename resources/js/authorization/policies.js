export default {
    modify(user, model) {
        return user.id === model.user_id;
    },

    deleteTodo(user, todo) {
        return user.id === todo.user_id;
    }
};
