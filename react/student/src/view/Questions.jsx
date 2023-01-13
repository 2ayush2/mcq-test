import { Typography } from "@mui/material";
import { Box } from "@mui/system";
import Loader from "components/Loader";
import { useEffect, useRef, useState } from "react";
import McqTable from "./McqTable";
import Result from "./Result";
import { pages } from "links";

const Questions = () => {
    //state that store complete transaction data of mcq
    const [state, setState] = useState({
        counter: 0, //max question that has been attempted
        current: 0, //current pointing question
        questionId: null, //current question id
        question: {}, //current question list
        answer: null, //current answer
        answersCount: {}, //all answer until now
        pre: false, //has previous question
        next: false, //has nest question
        length: 0, //total question length
        result: false,
        submit: false,
    });
    //store complete question on ref
    const quizQuestions = useRef();
    const testDetail = useRef();
    useEffect(async () => {
        //get question data from local storage
        const { code, student, questions, title } = JSON.parse(
            localStorage.getItem("questionList")
        );
        quizQuestions.current = questions;
        testDetail.current = { student, title, code };
        let count = 0;
        //set state with approprate date for initialization
        setState({
            ...state,
            counter: count,
            current: count,
            loading: false,
            answersCount: {},
            answer: null,
            questionId: quizQuestions.current[count].id,
            question: quizQuestions.current[count],
            length: quizQuestions.current.length,
        });
    }, []);
    //submit student answers
    async function onSubmit() {
        const ans = state.answersCount;
        console.log(ans, state.answersCount);
        const answers = { code: testDetail.current.code, answers: ans };
        const url = `${pages.BASE_URL}api/student/test/${testDetail.current.code}`;
        await fetch(url, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            method: "POST",
            mode: "cors",
            cache: "no-cache",
            referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(answers), // body data type must match "Content-Type" header}
        }).then((e) => {
            if (e.ok) {
                localStorage.removeItem("questionList");
                setState((pre) => ({
                    ...pre,
                    submit: true,
                }));
            }
        });
    }
    // save state when answer is selected
    function handleAnswerSelected(event) {
        const answer = event.currentTarget.value;
        //save current selected first answer
        setState((pre) => {
            const ans = {
                ...pre.answersCount,
                [pre.questionId]: answer,
            };
            console.log(pre.questionId, ans, answer);
            return {
                ...pre,
                answersCount: ans,
                answer: answer,
            };
        });
        //change the question after 300ms to transaction effect
        setTimeout(() => {
            setState((pre) => {
                if (pre.current < pre.length - 1) {
                    const current = pre.current + 1;
                    const counter =
                        pre.counter == pre.current ? current : pre.counter;
                    const qsn = quizQuestions.current[current];
                    return {
                        ...pre,
                        counter,
                        current: current,
                        questionId: qsn.id,
                        question: qsn,
                        answer: pre.answersCount[qsn.id],
                        next: pre.counter > current,
                        pre: current > 0,
                    };
                } else {
                    return { ...pre, result: true };
                }
            });
        }, 300);
    }
    // move to previous question
    function moveLeft() {
        if (state.current == 0) {
            return false;
        }
        setState((state, props) => {
            const current = state.current - 1;
            const qid = quizQuestions.current[current].id;
            return {
                ...state,
                current: current,
                questionId: qid,
                question: quizQuestions.current[current],
                answer: state.answersCount[qid],
                next: state.counter > current,
                pre: current > 0,
            };
        });
    }
    // move to next question
    function moveRight() {
        if (state.current == state.counter) {
            return false;
        }
        setState((state, props) => {
            const current = state.current + 1;
            const qid = quizQuestions.current[current].id;
            return {
                ...state,
                current: current,
                questionId: qid,
                question: quizQuestions.current[current],
                answer: state.answersCount[qid],
                next: state.counter > current,
                pre: current > 0,
            };
        });
    }

    //loader
    if (Boolean(quizQuestions.current) == 0) {
        return <Loader />;
    }
    //if all mcq are attempted show result page
    if (state.result) {
        return (
            <Result
                student={testDetail.current.student}
                submit={state.submit}
                onSubmit={onSubmit}
                onBack={() => {
                    setState((pre) => {
                        return {
                            ...pre,
                            result: false,
                        };
                    });
                }}
            />
        );
    }
    return (
        <Box>
            <Box
                display="flex"
                justifyContent="space-between"
                alignItems="center"
            >
                <Typography variant="h4">
                    {`Name : ${testDetail.current.student}`}
                </Typography>
                <Typography variant="h4">
                    {`Test : ${testDetail.current.title}`}
                </Typography>
            </Box>
            <McqTable
                moveLeft={moveLeft}
                moveRight={moveRight}
                state={state}
                handleAnswerSelected={handleAnswerSelected}
            />
        </Box>
    );
};

export default Questions;
