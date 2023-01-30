// @mui material components
import { useEffect } from 'react';
import { Link, useHistory } from 'react-router-dom';
// Soft UI Dashboard React components
import { Box, Button, Card, Typography } from '@mui/material';
// Soft UI Dashboard React example components
import { Table } from 'components/Table';
import { questionsPages } from 'links';
import { useSnackbar } from 'notistack';

import {
  columns,
  modelList,
  modelListInit,
  modelListEmpty
} from '../model/list';
import { getQuestionBank, deleteQuestion } from '../service';
import { useState } from 'react';
import { pages } from 'links';

function QuestionsBank() {
  const [questionList, setQuestion] = useState({
    questions: null
  });
  const history = useHistory();
  const { enqueueSnackbar } = useSnackbar();
  const handleView = async (id, name) => {
    await deleteQuestion(id).then((res) => {
      if (res.flag) {
        enqueueSnackbar('Question delete success', {
          variant: 'success'
        });
        loadData(1);
      }
    });
  };

  async function loadData(page) {
    await getQuestionBank({ page }).then((res) => {
      if (res.flag) {
        const qdata = res.data;
        console.log(qdata.data.length);
        if (qdata.status) {
          setQuestion({
            questions: qdata.data
          });
        }
      }
    });
  }
  useEffect(() => {
    loadData(1);
  }, []);

  const TableRender = () => {
    if (questionList.questions === null) {
      return (
        <div>
          <Table columns={columns} rows={modelListInit()} />
        </div>
      );
    } else if (questionList.questions.length == 0) {
      console.log('current');
      return (
        <div>
          <Table columns={columns} rows={modelListEmpty()} />
        </div>
      );
    } else {
      return (
        <div>
          <Table
            columns={columns}
            rows={modelList(questionList.questions, handleView)}
          />
        </div>
      );
    }
  };

  return (
    <Card>
      <Box
        display="flex"
        justifyContent="space-between"
        alignItems="center"
        p={3}
      >
        <Typography variant="h3">{'Questions Bank'}</Typography>
        <Link to={pages.QUESTIONS}>
          <Button variant="contained" color="info">
            Questionaries
          </Button>
        </Link>
      </Box>
      <Box>
        <TableRender />
      </Box>
    </Card>
  );
}

export default QuestionsBank;
