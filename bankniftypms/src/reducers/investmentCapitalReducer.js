import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function investmentCapitalReducer(
  state = initialState.investmentCapital,
  action
) {
  switch (action.type) {
    case types.INVESTMENT_CAPITAL_SUCCESS:
      return action.investmentCapital
    default:
      return state
  }
}
