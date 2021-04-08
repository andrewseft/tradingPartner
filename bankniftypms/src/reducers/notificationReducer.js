import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function notificationReducer(
  state = initialState.notification,
  action
) {
  switch (action.type) {
    case types.NOTIFICATION_DATA_SUCCESS:
      return action.notification
    default:
      return state
  }
}
