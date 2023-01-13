import KeyboardDoubleArrowLeftIcon from "@mui/icons-material/KeyboardDoubleArrowLeft";
import KeyboardDoubleArrowRightIcon from "@mui/icons-material/KeyboardDoubleArrowRight";
import { Box, Button, Divider, Typography } from "@mui/material";
import AnswerOption from "./AnswerOption";

export default function McqTable({
    moveLeft,
    moveRight,
    state,
    handleAnswerSelected,
}) {
    function renderAnswerOptions(ans, id) {
        return (
            <AnswerOption
                key={id}
                answerType={id}
                answerContent={ans}
                answer={state.answer}
                questionId={state.question.id}
                onAnswerSelected={handleAnswerSelected}
            />
        );
    }
    const qsnOptions = JSON.parse(state.question.options);
    return (
        <Box p={2}>
            <Divider />
            <Box
                py={2}
                display="flex"
                justifyContent="space-between"
                alignItems="center"
                textAlign={"center"}
            >
                <Button
                    variant="outlined"
                    disabled={!state.pre}
                    onClick={moveLeft}
                >
                    <KeyboardDoubleArrowLeftIcon />
                </Button>
                <Typography variant="h4" fontSize={18}>
                    Question {state.current + 1} of {state.length}
                </Typography>
                <Button
                    variant="outlined"
                    disabled={!state.next}
                    onClick={moveRight}
                >
                    <KeyboardDoubleArrowRightIcon />
                </Button>
            </Box>
            <Box>
                <Typography fontSize={18}>
                    <b>{state.question.type}</b>: {state.question.question}
                    <ul className="answerOptions">
                        {Object.values(qsnOptions).map(renderAnswerOptions)}
                    </ul>
                </Typography>
            </Box>
        </Box>
    );
}
