// @mui material components
import { useEffect } from 'react';
import { useHistory } from 'react-router-dom';
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
import { getQuestionList, sendMail } from '../service';
import { useState } from 'react';

function QuestionsList() {
  const [questionList, setQuestion] = useState({
    questions: null
  });
  const history = useHistory();
  const { enqueueSnackbar } = useSnackbar();
  const handleView = async (id, name) => {
    await sendMail(id).then((res) => {
      if (res.flag) {
        enqueueSnackbar('Mail send success', {
          variant: 'success'
        });
        loadData(1);
      }
    });
  };
  const handleCreate = (e, current) => {
    history.push(questionsPages.QUESTION_NEW);
  };

  async function loadData(page) {
    await getQuestionList({ page }).then((res) => {
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
        <Typography variant="h3">{'Questions'}</Typography>
        <Button variant="contained" onClick={handleCreate}>
          Create
        </Button>
      </Box>
      <Box>
        <TableRender />
      </Box>
    </Card>
  );
}

export default QuestionsList;
