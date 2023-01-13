import React from "react";
import PropTypes from "prop-types";

function AnswerOption(props) {
    return (
        <li className="answerOption">
            <input
                type="radio"
                className="radioCustomButton"
                name="radioGroup"
                checked={props.answerType == props.answer}
                id={"radio" + props.answerType}
                value={props.answerType}
                onClick={props.onAnswerSelected}
                onChange={() => {}}
            />
            <label
                className="radioCustomLabel"
                htmlFor={"radio" + props.answerType}
            >
                {props.answerContent}
            </label>
        </li>
    );
}

AnswerOption.propTypes = {
    answerType: PropTypes.number.isRequired,
    answerContent: PropTypes.string.isRequired,
    onAnswerSelected: PropTypes.func.isRequired,
};

export default AnswerOption;
