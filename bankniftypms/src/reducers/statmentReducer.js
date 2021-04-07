import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function statmentReducer(
  state = initialState.statement,
  action
) {
  switch (action.type) {
    case types.STATEMENT_DATA_SUCCESS:
      return action.statement
    default:
      return state
  }
}
