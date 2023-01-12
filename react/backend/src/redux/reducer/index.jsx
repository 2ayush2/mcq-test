import { combineReducers } from "redux";
import { userReducer } from "./userReducer";
import { questionListReducer } from "./questionReducer";

const reducers = combineReducers({
    user: userReducer,
    questionList: questionListReducer,
});

export default reducers;