import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function userDashbordReducer(
  state = initialState.userDashbord,
  action
) {
  switch (action.type) {
    case types.LOADED_USER_DASHBORD_SUCCESS:
      return action.userDashbord
    default:
      return state
  }
}
