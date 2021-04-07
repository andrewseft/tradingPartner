import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function passbookReducer(state = initialState.passbook, action) {
  switch (action.type) {
    case types.PASSBOOK_DATA_SUCCESS:
      return action.passbook
    default:
      return state
  }
}
