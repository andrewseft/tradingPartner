import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function amountReducers(
  state = initialState.walletAmount,
  action
) {
  switch (action.type) {
    case types.WALLET_SUCCESS:
      return action.walletAmount
    default:
      return state
  }
}
